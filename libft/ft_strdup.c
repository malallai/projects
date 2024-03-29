/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strdup.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/08 16:35:22 by malallai          #+#    #+#             */
/*   Updated: 2018/11/14 13:24:13 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strdup(const char *src)
{
	int		size;
	char	*dest;

	size = ft_strlen(src);
	if (!(dest = (char *)malloc(sizeof(*src) * (size + 1))))
		return (NULL);
	ft_strcpy(dest, src);
	return (dest);
}
