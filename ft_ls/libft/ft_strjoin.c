/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strjoin.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/08 17:20:13 by bclerc            #+#    #+#             */
/*   Updated: 2018/12/05 13:31:48 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"
#include <stdlib.h>

char	*ft_strjoin(char const *s1, char const *s2)
{
	char *rt;

	if (!s1 || !s2)
		return (NULL);
	if ((rt = ft_strnew(ft_strlen((char*)s1) + ft_strlen((char *)s2))) == NULL)
		return (NULL);
	rt = ft_strcpy(rt, s1);
	return (ft_strcat(rt, s2));
}
