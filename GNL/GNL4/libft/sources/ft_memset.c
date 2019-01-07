/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_memset.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/07 12:29:59 by malallai          #+#    #+#             */
/*   Updated: 2018/12/13 15:24:18 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

void	*ft_memset(void *str, int a, size_t len)
{
	char *temp;

	temp = str;
	while (len--)
		temp[len] = (unsigned char)a;
	return (str);
}
