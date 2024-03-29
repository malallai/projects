/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strcat.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/10 14:08:01 by malallai          #+#    #+#             */
/*   Updated: 2018/11/14 13:36:02 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strcat(char *restrict dst, const char *restrict src)
{
	int i;

	i = ft_strlen(dst);
	while (*src)
		dst[i++] = *src++;
	dst[i] = 0;
	return (dst);
}
